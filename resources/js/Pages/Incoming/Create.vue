<template>
  <AppLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Barang Masuk Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <jet-form-section @submitted="createincoming">
          <template #title> Barang Masuk  </template>

          <template #description>Input Barang Masuk. </template>

          <template #form>
            <!-- Kategori -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="stock_id" value="Pilih Barang" />
               <select class="form-select form-select-lg mt-1 block w-full" aria-label=".form-select-lg example" v-model="form.stock_id" v-for="stock in stocks" :key="stock.id" >
                <option selected >Pilih barang</option>
                <option v-bind:value="stock.id" > {{  stock.nama_barang  }}</option>
              </select>
              <jet-input-error :message="form.errors.stock_id" class="mt-2" />
            </div>

            <!-- Kategori -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="kategori" value="Kategori" />
               <select class="form-select form-select-lg mt-1 block w-full" aria-label=".form-select-lg example" v-model="form.kategori">
                <option selected >Pilih Kategori</option>
                <option value="Laptop" id="Laptop" >Laptop</option>
                <option value="Mouse" id="Mouse">Mouse</option>
                <option value="Tikus" id="Tikus">Tikus</option>
              </select>
              <jet-input-error :message="form.errors.kategori" class="mt-2" />
            </div>

            <!-- Jumlah -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="jumlah" value="Jumlah" />
              <jet-input
                id="jumlah"
                type="Number"
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
    stocks:Array,
  },

  setup() {
    const form = useForm({
      _method: "POST",
      stock_id: "",
      kategori: "",
      jumlah: "",
    });

    const createincoming = () => {
      form.post(route("incomings.store"));
    };

    return { form, createincoming };
  },
};
</script>
