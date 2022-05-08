<template>
    <AppLayout title="Kategori">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kategori Index
                <JetNavLink class="float-right" :href="route('kategoris.create')" v-if="$page.props.permission.kategoris.create">
                <JetButton >Input Kategori</JetButton>
                </JetNavLink>
            </h2>
        </template>

        <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-input
          type="text"
          class="block ml-2 mb-4 w-60"
          v-model="form.search"
          placeholder="Cari kategori..."
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
                          No
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Nama Kategori
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Updated At
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
                          <center>Action</center>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!kategoris.data.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>
                      <tr v-for="kategori in kategoris.data" :key="kategori.id">
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ kategori.id }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ kategori.kategori }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ kategori.created_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ kategori.updated_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                        >
                          <JetNavLink
                            :href="route('kategoris.show', kategori.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                            v-if="kategori.can.view"
                            >Show
                            </JetNavLink>
                          <JetNavLink
                            :href="route('kategoris.edit', kategori.id)"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                            v-if="kategori.can.update"
                            >Edit
                            </JetNavLink>
                          <button
                            @click="deletekategori(kategori.id)"
                            class="ml-2 text-red-600 hover:text-red-900"
                            v-if="kategori.can.delete">
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <JetPagination class="m-5" :links="kategoris.links" />
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
    kategoris: Object,
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
        route("kategoris.index", Object.keys(query).length ? query : {})
      );
    });

    const deletekategori = (kategoriId) => {
      const result = confirm("Apakah anda yakin?");
      if (result) {
        Inertia.delete(route("kategoris.destroy", kategoriId), {
          preserveScroll: true,
        });
      }
    };

    return { form, deletekategori };
  },
};
</script>
