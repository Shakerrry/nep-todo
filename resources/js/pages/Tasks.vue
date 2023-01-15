<template>
    <div class="my-[25px] h-auto container w-full lg:w-1/2 bg-white rounded-lg p-4">
      <p class="text-xl font-semibold mt-2 mb-4 text-[#063c76] text-center">Create your task</p>
      <add-task></add-task>
    </div>

    <div class="h-auto container w-full lg:w-1/2 bg-white rounded-lg p-4">
      <p class="text-xl font-semibold mt-2 text-[#063c76]">NEP Tasks</p>
      <span class="text-md font-regular text-indigo-400">Click on the task to mark as completed/uncompleted.</span>
      <task-list></task-list>
    </div>
</template>

<script>
import TaskList from "../components/TaskList.vue";
import AddTask from "../components/AddTask.vue";
export default {
  name: 'Tasks',
  components: {
    AddTask,
    TaskList
  }
};
</script>

<style>

</style>