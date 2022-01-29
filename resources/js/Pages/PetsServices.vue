<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                         class="h-20 w-20 rounded-full object-cover">
                    <span class="capitalize m1-3">
                        Services
                    </span>
                </h2>
            </div>
        </template>
        <button v-if="$page.props.user.role == 'ROLE_USER'" v-on:click="handleShowServiceAddForm" class="sendButton text-xs mt-2 mb-2">Add</button>
        <jet-confirmation-modal :show="this.showServiceAddForm" @close="false" max-width="md">
            <template #content>
                <form @submit.prevent="submit" class="w-full" v-if="this.isEmptyServices || this.showServiceAddForm">
                    <div>
                        <select v-model="form.pet_name" class="flex border rounded px-2 py-2 w-60">
                            <option v-for="(pet,key) in pets" :key="key">
                                {{ pet.name }}
                            </option>
                        </select>
                        <div>
                            <jet-input-error :message="form.errors.pet_name" class="mt-2" v-if="form.errors.pet_name"></jet-input-error>
                        </div>
                        <input type="date"  v-model="form.service_date"  class="flex border rounded px-2 py-2 w-25 mt-2">
                        <input type="text"  v-model="form.service_type"  class="flex border rounded px-2 py-2 w-25 mt-2">
                        <div>
                            <jet-input-error :message="form.errors.service_type" class="mt-2" v-if="form.errors.service_type"></jet-input-error>
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="handleHideServiceAddForm">
                    Cancel
                </jet-secondary-button>
                <jet-danger-button type="submit" class="ml-2" @click.native="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
        <services v-if="!this.isEmptyServices" :services="services"></services>
    </pages-layout>
</template>

<script>
import { defineComponent } from 'vue'
import PagesLayout from '@/Layouts/PagesLayout.vue'
import Pets from '@/Components/Pets/PetsShow'
import Services from '@/Components/Services/ServicesShow'
import JetInputError from '@/Jetstream/InputError'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'


export default defineComponent({
    props: ['pets', 'services'],
    components: {
        PagesLayout,
        Pets,
        Services,
        JetInputError,
        JetDangerButton,
        JetSecondaryButton,
        JetConfirmationModal,
    },
    data() {
        return {
            form: this.$inertia.form({
                user_id: this.$page.props.user.id,
                pet_name: this.pet_name,
                service_date: this.service_date,
                service_type: this.service_type,
            }),
             isEmptyServices: null,
             showServiceAddForm: false,
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('services.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Your service has successfully been added!',
                    });
                    this.form.user_id = null;
                    this.form.pet_name = null;
                    this.form.service_date = null;
                    this.form.service_type = null;
                    this.isEmptyServices = false;
                    this.showServiceAddForm = false;
                },
                onError: () => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    });
                }
            })
        },

             handleIsEmptyServices() {
                 this.isEmptyServices = this.services.length === 0;
             },

             handleShowServiceAddForm() {
                 this.showServiceAddForm = true;
             },

             handleHideServiceAddForm() {
                 this.showServiceAddForm = false;
            },
        },
        beforeMount() {
            this.handleIsEmptyServices();
        }
});
</script>
