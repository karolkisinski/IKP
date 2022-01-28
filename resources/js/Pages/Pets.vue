<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                         class="h-20 w-20 rounded-full object-cover">
                    <span class="capitalize m1-3">
                        Pets
                    </span>
                </h2>
            </div>
        </template>
<!--        <form @submit.prevent="submit" class="w-full" v-if="this.isEmptyPets || this.showPetAddForm">-->
<!--            <div>-->
<!--                <input name="name" class="flex border rounded px-2 py-2 w-25" placeholder="Add your pet name" v-model="form.name">-->
<!--                    <div>-->
<!--                        <jet-input-error :message="form.errors.name" class="mt-2" v-if="form.errors.name"></jet-input-error>-->
<!--                    </div>-->
<!--                <input name="race" class="flex border rounded px-2 py-2 w-25 mt-2" placeholder="Add your pet race" v-model="form.race">-->
<!--                    <div>-->
<!--                        <jet-input-error :message="form.errors.race" class="mt-2" v-if="form.errors.race"></jet-input-error>-->
<!--                    </div>-->
<!--                <input name="age" type="number" class="flex border rounded px-2 py-2 w-25 mt-2" placeholder="Add your pet age" v-model="form.age">-->
<!--                    <div>-->
<!--                        <jet-input-error :message="form.errors.age" class="mt-2" v-if="form.errors.age"></jet-input-error>-->
<!--                    </div>-->
<!--            </div>
            <div>
                <button id="petAddButton" type="submit" class="sendButton text-xs mt-2 mb-2">Send</button>
            </div>
            </form>-->
        <button v-on:click="handleShowPetAddForm" data-target="addPetModal" data-toggle="modal" class="sendButton text-xs mt-2 mb-2">Add</button>
<!--        <div v-if="!this.isEmptyPets && !this.showPetAddForm">-->
<!--            <button v-on:click="handleShowPetAddForm" id="petShowFormButton" class="sendButton text-xs mt-2 mb-2">Add pet</button>-->
<!--        </div>-->

        <jet-confirmation-modal :show="this.showPetAddForm" @close="false" max-width="md">
            <template #content>
                <form @submit.prevent="submit" class="w-full" v-if="this.isEmptyPets || this.showPetAddForm">
                    <div>
                        <input name="name" class="flex border rounded px-2 py-2 w-25" placeholder="Add your pet name" v-model="form.name">
                        <div>
                            <jet-input-error :message="form.errors.name" class="mt-2" v-if="form.errors.name"></jet-input-error>
                        </div>
                        <input name="race" class="flex border rounded px-2 py-2 w-25 mt-2" placeholder="Add your pet race" v-model="form.race">
                        <div>
                            <jet-input-error :message="form.errors.race" class="mt-2" v-if="form.errors.race"></jet-input-error>
                        </div>
                        <input name="age" type="number" class="flex border rounded px-2 py-2 w-25 mt-2" placeholder="Add your pet age" v-model="form.age">
                        <div>
                            <jet-input-error :message="form.errors.age" class="mt-2" v-if="form.errors.age"></jet-input-error>
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="handleHidePetAddForm">
                    Anuluj
                </jet-secondary-button>

                <jet-danger-button type="submit" class="ml-2" @click.native="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Zapisz
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
<!--        <div v-if="this.isAdmin">-->
<!--            Dupa 1-->
<!--        </div>-->
<!--        <div>-->
<!--            Dupa 2-->
<!--        </div>-->
        <pets v-if="!this.isEmptyPets" :pets="pets" @deletePet="handleIsEmptyPets"></pets>
    </pages-layout>
</template>

<script>
import { defineComponent } from 'vue'
import PagesLayout from '@/Layouts/PagesLayout.vue'
import Pets from '@/Components/Pets/PetsShow'
import JetInputError from '@/Jetstream/InputError'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'


export default defineComponent({
    props: ['pets'],
    components: {
        PagesLayout,
        Pets,
        JetInputError,
        JetDangerButton,
        JetSecondaryButton,
        JetConfirmationModal,
    },
    data() {
        return {
            form: this.$inertia.form({
                user_id: this.$page.props.user.id,
                name: this.name,
                race: this.race,
                age: this.age,
            }),
            isEmptyPets: null,
            showPetAddForm: false,
            isAdmin: null,
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('pets.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Your pet has successfully been added!',
                    });
                    this.form.name = null;
                    this.form.race = null;
                    this.form.age = null;
                    this.isEmptyPets = false;
                    this.showPetAddForm = false;
                },
                onError: () => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    });
                }
            })
        },

        handleIsEmptyPets() {
            this.isEmptyPets = this.pets.length === 0;
        },

        handleShowPetAddForm() {
            this.showPetAddForm = true;
        },

        handleHidePetAddForm() {
            this.showPetAddForm = false;
        },

        handleIsAdmin() {
            this.isAdmin = this.$page.props.user.role === 'ROLE_ADMIN';
        },
    },
    beforeMount() {
        this.handleIsEmptyPets();
        this.handleIsAdmin();
    }
});
</script>
