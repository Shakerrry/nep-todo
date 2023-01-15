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

// export const addProductToCart = ({ commit, dispatch }, { product, quantity }) => {
//     commit('ADD_TO_CART', { product, quantity });
//
//     dispatch('addNotification', {
//         type: 'success',
//         message: 'Product added to cart.'
//     }, { root: true });
//
//     Cart.store({
//         product_id: product.id,
//         quantity
//     });
// }

// export const getCartItems = ({ commit }) => {
//     Cart.all().then(response => {
//         commit('SET_CART', response.data);
//     })
// }
//
// export const removeProductFromCart = ({ commit, dispatch }, product) => {
//     commit('REMOVE_PRODUCT_FROM_CART', product);
//
//     dispatch('addNotification', {
//         type: 'success',
//         message: 'Product removed from cart.'
//     }, { root: true });
//
//     Cart.delete(product.id);
// }
//
// export const clearCartItems = ({ commit, dispatch }) => {
//     commit('CLEAR_CART_ITEMS');
//
//     dispatch('addNotification', {
//         type: 'success',
//         message: 'All products removed from cart.'
//     }, { root: true });
//
//     Cart.deleteAll();
// }