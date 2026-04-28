import setup from ".";
import All from "../pages/All.vue";
import Form from "../pages/Form.vue";
import Details from "../pages/Details.vue";
import Layout from "../pages/Layout.vue";

let route_prefix = setup.route_prefix;
let route_path = setup.route_path;

const routes = {
    path: route_path,
    component: Layout,
    children: [
        {
            path: "",
            redirect: { name: "Create" + route_prefix },
        },
        {
            path: "create",
            name: "Create" + route_prefix,
            component: Form,
        },
    ],
};

export default routes;

