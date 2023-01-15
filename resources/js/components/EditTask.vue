<template>
  <input placeholder="Type task name*" type="text"
         v-model="store.state.task.task.name"
         :class="(errors.name) ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500': 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500'"
         class="mt-1 block w-full border rounded-md shadow-sm p-4">
  <p v-show="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
  <textarea rows="2"
            :class="(errors.description) ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500': 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500'"
            class="mt-3 block w-full rounded-md border shadow-sm py-2.5 px-4"
            v-model="store.state.task.task.description"
            placeholder="Description"></textarea>
  <p v-show="errors.description" class="mt-2 text-sm text-red-600">{{ errors.description }}</p>
  <div class="flex items-center my-4">
    <input type="checkbox" class="h-6 w-6 border-gray-300 text-indigo-600 focus:ring-indigo-500" v-model="store.state.task.task.completed">
    <label class="ml-3 block text-md font-medium text-gray-700">Completed</label>
  </div>
  <div class="flex gap-2">
    <button
        @click="goBack()"
        class="mt-3 inline-flex items-center justify-center rounded-md border border-transparent bg-gray-200 px-5 py-3 text-base font-medium text-indigo-600 hover:bg-gray-500">
      Back
    </button>
    <button
        @click="saveTask()"
        class="mt-3 w-full inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">
      Save task
    </button>
  </div>
</template>

<script>
import {watch, reactive} from "vue";
import {useStore} from "vuex";
import router from "../router";

export default {
  name: 'EditTask',
  components: {},
  setup() {
    const store = useStore();

    const errors = reactive({
      'name': '',
      'description': ''
    });

    function saveTask() {
      store.dispatch('task/updateTask', store.state.task.task).then(() => {
        errors.name = errors.description = '';
        router.push('/');
      }).catch(e => {
        // validation error
        if (e.response.status === 422) {
          Object.keys(e.response.data.errors).forEach(key => {
            errors[key] = e.response.data.errors[key][0];
          });
        } else {
          alert("There was an error calling the API");
        }
      });
    }

    function goBack () {
      router.push('/');
    }

    watch(() => [store.state.task.task.name, store.state.task.task.description], () => {
      errors.name = errors.description = '';
    });

    return {
      saveTask,
      goBack,
      errors,
      store
    };
  }
};
</script>
