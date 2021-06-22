<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Access;
use App\Models\Skill;
use Exception;

class UserService
{
    /**
     * Var for user entity
     *
     * @var object
     */
    private $user;

    /**
     * Var for skill entity
     *
     * @var object
     */
    private $skill;

    /**
     * Var for access entity
     *
     * @var object
     */
    private $access;

    /**
     * Inject dependencies
     *
     * @param User $user
     * @param Skill $skill
     * @param Access $access
     */
    public function __construct(User $user, Skill $skill, Access $access)
    {
        $this->user = $user;
        $this->skill = $skill;
        $this->access = $access;
    }

    /**
     * Fetch all users
     *
     * @return object
     */
    public function fetchAll(): object
    {
        try {
            return $this->user->orderBy('id', 'desc')->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Fetch All data from user id based on id
     *
     * @param integer $id
     * @return object
     */
    public function fetchCompleteUserById(int $id): object
    {
        try {
            $user = $this->user->with('skill')->with('access')->where('id', $id)->first();
            if (!$user) {
                throw new Exception('User not found');
            }

            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Store a new user
     *
     * @param array $data
     * @return object
     */
    public function store(array $data): object
    {
        try {
            DB::beginTransaction();
            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            $data['user_id'] = $user->id;

            $skill = true;
            if (!empty($data['experience'] || !empty($data['skill']))) {
                $skill = $this->skill->create($data);
            }

            $access = $this->access->create($data);
            if ($user && $skill && $access) {
                DB::commit();
                return $this->fetchCompleteUserById($user->id);
            }

            DB::rollBack();
            throw new Exception('Something went wrong');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Store a new user
     *
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update(int $id, array $data): object
    {
        try {
            DB::beginTransaction();

            if (!$user = $this->user->find($id)) {
                throw new Exception('User not found');
            }

            $user->update($data);
            $completeUser = $this->fetchCompleteUserById($id);

            $skill = $completeUser->skill;
            $data['user_id'] = $id;
            if (!empty($skill)) {
                $skill = $skill->update($data);
            } else {
                $skill = $skill->create($data);
            }

            $access = $completeUser->access;
            if (empty($access)) {
                throw new Exception('Access not found');
            }

            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            $access = $access->update($data);

            if ($user && $skill && $access) {
                DB::commit();
                return $completeUser;
            }

            DB::rollBack();
            throw new Exception('Something went wrong');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete User by id
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $user = $this->user->find($id);
            if (!$user) {
                throw new Exception('User not found');
            }

            $user->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
