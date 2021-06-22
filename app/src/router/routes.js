import Home from "@/views/Home";
import StoreUpdate from "@/views/StoreUpdate";

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/users/store",
    name: "users.store",
    component: StoreUpdate,
  },
  {
    path: "/users/:id/edit",
    name: "users.edit",
    component: StoreUpdate,
    props: true,
  },
];

export default routes;
