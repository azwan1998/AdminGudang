<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Show Barang
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5">
                    <a v-for="out in outs" :key="out">
                        Nama Barang = {{ out.stock.nama_barang }} <br>
                        Kategori = {{ out.kategori.kategori }} <br>
                        jumlah = {{ out.jumlah }} <br>
                        Created At = {{ out.created_at }} <br>
                        Updated At = {{ out.updated_at }} <br>
                    </a>
                    
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

  props:{
      outs:Array,
  },
};
</script>