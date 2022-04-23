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
                    Nama Barang = {{ incoming.nama_barang }} <br>
                    Kategori = {{ incoming.kategori }} <br>
                    jumlah = {{ incoming.jumlah }} <br>
                    Created At = {{ incoming.created_at }} <br>
                    Updated At = {{ incoming.updated_at }} <br>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
  components: {
    AppLayout,
  },

  props: ['incoming']
};
</script>