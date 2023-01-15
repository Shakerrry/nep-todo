import Api from "./Api";

const END_POINT = 'tasks';

export default {
    all() {
        return Api.get(END_POINT);
    },

    show(id) {
        return Api.get(`${END_POINT}/${id}`);
    },

    store(data) {
        return Api.post(END_POINT, data);
    },

    update(id, data) {
        return Api.patch(`${END_POINT}/${id}`, data);
    },

    delete(id) {
        return Api.delete(`${END_POINT}/${id}`);
    },
}