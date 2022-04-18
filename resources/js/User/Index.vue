<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Index
                <JetNavLink class="float-right" :href="route('posts.create')" v-if="$page.props.posts.create">
                <JetButton >Create</JetButton>
                </JetNavLink>
            </h2>
        </template>

        <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-input
          type="text"
          class="block ml-2 mb-4 w-60"
          v-model="form.search"
          placeholder="Cari user..."
        />
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
              >
                <div
                  class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          ID
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Name
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Created At
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Updated At
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!users.data.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>
                      <tr v-for="user in users.data" :key="user.id">
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ user.id }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ user.title }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ user.created_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ user.updated_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                        >
                          <JetNavLink
                            :href="route('posts.show', user.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                            v-if="user.can.view"
                            >Show</JetNavLink
                          >
                          <JetNavLink
                            :href="route('posts.edit', user.id)"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                            v-if="user.can.update"
                            >Edit</JetNavLink
                          >
                          <button
                            @click="deletePost(user.id)"
                            class="ml-2 text-red-600 hover:text-red-900"
                            v-if="user.can.delete"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <JetPagination class="m-5" :links="users.links" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </AppLayout>
</template>

<script>
import { reactive, watchEffect } from "vue";
import { pickBy } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetPagination from "@/Components/Pagination";
import JetNavLink from '@/Jetstream/NavLink.vue';

export default {
  components: {
    AppLayout,
    JetButton,
    JetInput,
    JetPagination,
    JetNavLink,
  },

  props: {
    users: Object,
    filters: Object,
  },

  setup(props) {
    const form = reactive({
      search: props.filters.search,
      page: props.filters.page,
    });

    watchEffect(() => {
      const query = pickBy(form);

      Inertia.replace(
        route("user.index", Object.keys(query).length ? query : {})
      );
    });

    const deletePost = (postId) => {
      const result = confirm("Apakah anda yakin?");
      if (result) {
        Inertia.delete(route("users.destroy", postId), {
          preserveScroll: true,
        });
      }
    };

    return { form, deletePost };
  },
};
</script>
