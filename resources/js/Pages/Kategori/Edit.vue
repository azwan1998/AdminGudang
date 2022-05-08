<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kategori Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <JetFormSection @submitted="updateKategori">
                <template #title>
                  Update Kategori.
                </template>

                <template #description>
                    Update Kategori.
                </template>

        <template #form>
            <!-- Kategori -->
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

   props :{
    kategori:Array,
  },

  setup(props) {
    const form = useForm({
      _method: 'PUT',
      kategori: props.kategori.kategori,
    });

     const updateKategori = () => {
      form.post(route("kategoris.update", props.kategori.id), {
        preserveScroll: true,
      });
    };

    return { form, updateKategori };
  },
};
</script>
