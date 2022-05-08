<template>
  <AppLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-form-section @submitted="createStock">
          <template #title> Create Post </template>

          <template #description> Membuat postingan. </template>

          <template #form>
            <!-- Nama Barang -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="nama_barang" value="Nama Barang" />
              <jet-input
                id="nama_barang"
                type="text"
                class="mt-1 block w-full"
                v-model="form.nama_barang"
                autocomplete="nama_barang"
              />
              <jet-input-error :message="form.errors.nama_barang" class="mt-2" />
            </div>

          <!-- Kategori -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="kategori_id" value="Kategori" />
               <select class="form-select form-select-lg mt-1 block w-full" aria-label=".form-select-lg example" v-model="form.kategori_id">
                <option v-for="kategori in kategoris" :key="kategori.id" v-bind:value="kategori.id" > {{  kategori.kategori  }}</option>
              </select>
              <jet-input-error :message="form.errors.kategori" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <jet-label for="merk" value="merk" />
              <jet-input
                id="merk"
                type="text"
                class="mt-1 block w-full"
                v-model="form.merk"
                autocomplete="merk"
              />
              <jet-input-error :message="form.errors.merk" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <jet-label for="jumlah" value="jumlah" />
              <jet-input
                id="jumlah"
                type="number"
                class="mt-1 block w-full"
                v-model="form.jumlah"
                autocomplete="jumlah"
              />
              <jet-input-error :message="form.errors.jumlah" class="mt-2" />
            </div>   
          </template>

          <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              Saved.
            </jet-action-message>
              <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Save
            </jet-button>
            
          </template>
        </jet-form-section>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSelect from "@/Components/Select";

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
    JetSelect,
  },

  props :{
    kategoris:Array,
  },

  setup() {
    const form = useForm({
      _method: "POST",
      nama_barang: "",
      kategori_id: "",
      merk: "",
      jumlah: "",
    });

    const createStock = () => {
      form.post(route("stocks.store"));
    };

    return { form, createStock };
  },
};
</script>
