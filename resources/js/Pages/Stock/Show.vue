<template>
    <GuestLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Barang Show
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5">
                    <h2 class="text-xl font-bold">{{ stock.nama_barang }}</h2>
                    <!-- <div class="mb-2">Author : {{ post.user.name }}</div> -->
                    <div class="whitespace-pre-line">{{ stock.kategori_id }}</div>
                    <div class="whitespace-pre-line">{{ stock.merk }}</div>
                    <div class="whitespace-pre-line">{{ stock.jumlah }}</div>
                    <div class="whitespace-pre-line">{{ stock.created_at }}</div>
                    <div class="whitespace-pre-line">{{ stock.updated_at }}</div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';

export default {
  components: {
    GuestLayout,
  },

  props: {
    stock: Object,
  },
};
</script>
