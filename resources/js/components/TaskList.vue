<template>
  <ul class="my-4">
    <task-item v-if="tasks" v-for="task in tasks" :key="task.id" :task="task"></task-item>
    <h1 v-else class="text-center text-xl text-gray-500">There are currently no tasks. Please add one using the form above :)</h1>
  </ul>
</template>

<script>
import TaskItem from "./TaskItem.vue";
import {computed} from 'vue';
import {useStore} from "vuex";

export default {
  name: 'TaskList',
  components: {
    TaskItem
  },

  setup(){
    const store = useStore();

    store.dispatch('task/getTasks');

    let tasks = computed(function () {
      return store.state.task.tasks;
    });

    return {
      tasks
    };
  },
}
</script>