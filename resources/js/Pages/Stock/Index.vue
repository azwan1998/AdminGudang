<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Barang Index
                <!-- <JetNavLink class="float-right" :href="route('s.create')" v-if="$page.props.permission.stocks.create">
                <JetButton >Input Barang Keluar</JetButton>
                </JetNavLink> -->
            </h2>
        </template>

        <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-input
          type="text"
          class="block ml-2 mb-4 w-60"
          v-model="form.search"
          placeholder="Cari Barang Keluar..."
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
                          Nama Barang
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Kategori
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Merk
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Jumlah
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
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!stocks.data.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>
                      <tr v-for="stock in stocks.data" :key="stock.id">
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.id }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.nama_barang }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.kategori }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.merk }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.jumlah }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.created_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ stock.updated_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                        >
                          <!-- <JetNavLink
                            :href="route('outs.show', out.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                            v-if="out.can.view"
                            >Show
                            </JetNavLink>
                          <JetNavLink
                            :href="route('outs.edit', out.id)"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                            v-if="out.can.update"
                            >Edit
                            </JetNavLink>
                          <button
                            @click="deleteout(out.id)"
                            class="ml-2 text-red-600 hover:text-red-900"
                            v-if="out.can.delete">
                            Delete
                          </button> -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <JetPagination class="m-5" :links="stocks.links" />
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
    stocks: Object,
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
        route("stocks.index", Object.keys(query).length ? query : {})
      );
    });

    // const deleteout = (outId) => {
    //   const result = confirm("Apakah anda yakin?");
    //   if (result) {
    //     Inertia.delete(route("outs.destroy", outId), {
    //       preserveScroll: true,
    //     });
    //   }
    // };

    return { form };
  },
};
</script>
