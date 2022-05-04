<template>
  <AppLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Barang Keluar Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-form-section @submitted="createincoming">
          <template #title> Barang Keluar  </template>

          <template #description>Input Barang Keluar. </template>

          <template #form>
            <!-- @foreach ($stock as $st) -->
            <!-- Nama Barang -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="kategori" value="Kategori" />
               <select class="form-select form-select-lg mt-1 block w-full" aria-label=".form-select-lg example" v-model="form.kategori">
                <option selected >Pilih Kategori</option>
                <!-- <option value="Laptop" >{{ $st->kategori }}</option> -->
              </select>
              <jet-input-error :message="form.errors.kategori" class="mt-2" />
            </div>
            <!-- @endforeach -->
            <!-- Kategori -->
            <div class="col-span-6 sm:col-span-4" >
              <jet-label for="kategori" value="Kategori" />
               <select class="form-select form-select-lg mt-1 block w-full" aria-label=".form-select-lg example" v-model="form.kategori" v-for="stock in stocks.data" :key="stock.id" >
                <option value="" id="Laptop" > {{  stock.kategori }} </option>
                <option value="Mouse" id="Mouse">Mouse</option>
                <option value="Tikus" id="Tikus">Tikus</option>
              </select>
              <jet-input-error :message="form.errors.kategori" class="mt-2" />
            </div>

            <!-- Merk -->
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

  props: {
    outs: Object,
    stocks:Array,
  },

  setup() {
    const form = useForm({
      _method: "POST",
      kategori: "",
      kategori: "",
      merk: "",
      jumlah: "",
    });

    const createout = () => {
      form.post(route("outs.store"));
    };

    return { form, createout };
  },
};
</script>
