<template>
  <div class="my-[25px] h-auto container w-full lg:w-1/2 bg-white rounded-lg p-4">
    <p class="text-xl font-semibold mt-2 mb-4 text-[#063c76] text-center">Edit task</p>
    <p class="mb-3">ID: <span class="bg-indigo-400 text-white text-sm py-0.5 px-2 rounded-full">{{ task.id }}</span></p>
    <p class="mb-3">Updated at: <span class="bg-indigo-400 text-white text-sm py-0.5 px-2 rounded-full">{{ formatDate(task.updated_at) }}</span></p>
    <p class="mb-3">Created at: <span class="bg-indigo-400 text-white text-sm py-0.5 px-2 rounded-full">{{ formatDate(task.created_at) }}</span></p>
    <edit-task></edit-task>
  </div>
</template>

<script>
import EditTask from "../components/EditTask.vue";
import {useStore} from "vuex";
import {computed} from "vue";
import moment from "moment";
export default {
  name: 'TaskDetails',
  props: [
      'id'
  ],
  components: {
    EditTask,
  },

  setup(props){
    const store = useStore();

    store.dispatch('task/getTask', props.id);

    let task = computed(function () {
      return store.state.task.task;
    });

    function formatDate(date) {
      return moment(date).format('DD-MM-YYYY HH:mm');
    }

    return {
      task,
      formatDate
    };
  },
};
</script>

<style>

</style>