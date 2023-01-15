<template>
  <li class="mt-7" id="1">
    <div class="flex gap-2">
      <div class="relative w-full bg-[#e0ebff] rounded-[7px] flex justify-start items-center p-3 cursor-pointer" @click="complete()">
        <span class="absolute bg-indigo-500 -top-4 rounded-lg shadow-lg right-0 px-4 py-1 text-sm text-white font-regular italic">{{ formattedDate }}</span>
        <span :class="(task.completed) ? 'green' : ''" class="w-[33px] h-[30px] bg-white rounded-full border border-white transition-all hover:border-[#36d344] flex justify-center items-center"><i class="text-white fa fa-check"></i></span>
        <div class="flex flex-col w-full ml-4 text-[#5b7a9d]">
          <strike :class="(!task.completed) ? 'strike_none' : ''" class="text-md font-semibold">{{ task.name }}</strike>
          <strike :class="(!task.completed) ? 'strike_none' : ''" class="text-sm font-regular">{{ task.description }}</strike>
        </div>
      </div>
      <button
          @click="showTask()"
          class="inline-flex items-center justify-center rounded-md border border-transparent bg-violet-600 px-3 py-3 text-base font-medium text-white hover:bg-violet-700">
        <i class="text-white fa fa-eye"></i>
      </button>
      <button
          @click="deleteTask()"
          class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-600 px-3 py-3 text-base font-medium text-white hover:bg-red-700">
        <i class="text-white fa fa-trash"></i>
      </button>
    </div>
  </li>
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";
import moment from "moment";
import router from "../router";

export default {
  name: 'TaskItem',
  components: {
  },
  props: [
      'task',
  ],
  setup(props) {

    const store = useStore();

    function complete(){
      props.task.completed = !props.task.completed;
        store.dispatch("task/updateTask", props.task);
    }

    function deleteTask() {
      store.dispatch("task/deleteTask", props.task.id);
    }

    function showTask() {
      router.push(`/task/${props.task.id}`)
    }

    const formattedDate = computed(() => {
      return moment(props.task.updated_at).format('DD-MM-YYYY HH:mm');
    })

    return {
      complete,
      deleteTask,
      showTask,
      formattedDate
    }
  }
};
</script>

<style>
.strike_none{
  text-decoration:none;
}
.green{
  background-color:green !important;
}
</style>