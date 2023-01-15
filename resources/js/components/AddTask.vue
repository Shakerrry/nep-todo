<template>
  <input placeholder="Type task name*" type="text"
         v-model="data.name"
         :class="(errors.name) ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500': 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500'"
         class="mt-1 block w-full border rounded-md shadow-sm p-4">
  <p v-show="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
  <textarea rows="2"
            :class="(errors.description) ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500': 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500'"
            class="mt-3 block w-full rounded-md border shadow-sm py-2.5 px-4"
            v-model="data.description"
            placeholder="Description"></textarea>
  <p v-show="errors.description" class="mt-2 text-sm text-red-600">{{ errors.description }}</p>
  <button
      @click="addTask()"
      class="mt-3 w-full inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">
    Add task
  </button>
</template>

<script>
import {watch, reactive} from "vue";
import {useStore} from "vuex";

export default {
  name: 'AddTask',
  components: {},
  setup() {
    const store = useStore();

    const data = reactive({
      'name': '',
      'description': ''
    });

    const errors = reactive({
      'name': '',
      'description': ''
    });

    function addTask() {
        store.dispatch('task/addTask', data).then(() => {
          data.name = data.description = errors.name = errors.description = '';

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

    watch(() => [data.name, data.description], () => {
      errors.name = errors.description = '';
    });

    return {
      addTask,
      data,
      errors
    };
  }
};
</script>
