<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Barang Masuk Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <JetFormSection @submitted="updateincoming">
        <template #title>
           Update 
        </template>

        <template #description>
            Edit Barang Masuk
        </template>

        <template #form>

            <!-- nama barang -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="nama_barang" value="Nama_barang" />
              <jet-input
                id="nama_barang"
                type="text"
                class="mt-1 block w-full"
                v-model="form.nama_barang"
                autocomplete="nama_barang"
              />
              <jet-input-error :message="form.errors.nama_barang" class="mt-2" />
            </div>
            <!-- kategori -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="kategori" value="Kategori" />
              <jet-input
                id="kategori"
                type="text"
                class="mt-1 block w-full"
                v-model="form.kategori"
                autocomplete="kategori"
              />
              <jet-input-error :message="form.errors.kategori" class="mt-2" />
            </div>
            <!-- merk -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="merk" value="Merk" />
              <jet-input
                id="merk"
                type="text"
                class="mt-1 block w-full"
                v-model="form.merk"
                autocomplete="merk"
              />
              <jet-input-error :message="form.errors.merk" class="mt-2" />
            </div>
            <!-- jumlah -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="jumlah" value="Jumlah" />
              <jet-input
                id="jumlah"
                type="text"
                class="mt-1 block w-full"
                v-model="form.jumlah"
                autocomplete="jumlah"
              />
              <jet-input-error :message="form.errors.jumlah" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </JetFormSection>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';


export default {
  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
  },

  props: ['incoming'],

  setup(props) {
    const form = useForm({
    _method: 'PUT',
    nama_barang: props.incoming.nama_barang,
    kategori: props.incoming.kategori,
    merk: props.incoming.merk,
    jumlah: props.incoming.jumlah,
    });

     const updateincoming = () => {
      form.post(route("incomings.update", props.incoming.id), {
        preserveScroll: true,
      });
    };

    return { form, updateincoming };
  },
};
</script>
