import Task from "../../../apis/Task";

export const getTasks = ({ commit }) => {
    Task.all().then(response => {
        commit('SET_TASKS', response.data.tasks);
    })
}

export const updateTask = ({ commit, dispatch }, data) => {
    return Task.update(data.id, data).then(response => {
        dispatch('getTasks');
    })
}

export const deleteTask = ({ commit, dispatch }, taskId) => {
    Task.delete(taskId).then(response => {
        dispatch('getTasks');
    })
}

export const getTask = ({ commit }, taskId) => {
    Task.show(taskId).then(response => {
        commit('SET_TASK', response.data.task);
    })
}

export const addTask = ({ commit, dispatch }, data) => {
    return Task.store(data).then(response => {
        dispatch('getTasks');
    })
}