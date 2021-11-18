import Pages from "./../pages/index.vue";

let prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
    ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
    : "/badaso-dashboard";

export default [
    {
        path: prefix + "/path_url", // add path url
        name: "TestExamplePage", // add name page this
        component: Pages,
        meta: {
            title: "Content Manager", // add title for tap browse
            useComponent: "AdminContainer"
        }
    }
];
