import {createRouter, createWebHistory } from "vue-router";
import Tasks from "../pages/Tasks.vue";
import TaskDetails from "../pages/TaskDetails.vue";

const routes = [
    {
        path: "/",
        name: "tasks",
        component: Tasks,
    },
    {
        path: "/task/:id",
        name: "task",
        props: true,
        component: TaskDetails,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;