<template>
    <div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                        Race
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                        Age
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                        Edit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(pet, key) in pets" :key="key">
                                    <td class="px-6 py-4 whitespace-nowrap text-xxs md:text-xs lg:text-sm">
                                        {{ pet.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xxs md:text-xs lg:text-sm">
                                        {{ pet.race }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-xxs md:text-xs lg:text-sm">
                                        {{ pet.age }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-xxs md:text-xs lg:text-sm">
                                        <button v-on:click="handleShowPetEditForm(pet.id, key)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-xxs md:text-xs lg:text-sm">
                                        <form @submit.prevent="deletePet(pet.id)">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <jet-confirmation-modal :show="this.showPetEditForm" @close="false" max-width="md">
        <template #content>
            <form @submit.prevent="submit" class="w-full" v-if="this.showPetEditForm">
                <div>
                    <input name="name" class="flex border rounded px-2 py-2 w-25" placeholder="Add your pet name" v-model="editForm.name">
                    <div>
                        <jet-input-error :message="editForm.errors.name" class="mt-2" v-if="editForm.errors.name"></jet-input-error>
                    </div>
                    <input name="race" class="flex border rounded px-2 py-2 w-25 mt-2" placeholder="Add your pet race" v-model="editForm.race">
                    <div>
                        <jet-input-error :message="editForm.errors.race" class="mt-2" v-if="editForm.errors.race"></jet-input-error>
                    </div>
                    <input name="age" type="number" class="flex border rounded px-2 py-2 w-25 mt-2" placeholder="Add your pet age" v-model="editForm.age">
                    <div>
                        <jet-input-error :message="editForm.errors.age" class="mt-2" v-if="editForm.errors.age"></jet-input-error>
                    </div>
                </div>
            </form>
        </template>

        <template #footer>
            <jet-secondary-button @click.native="handleHidePetAddForm">
                Anuluj
            </jet-secondary-button>

            <jet-danger-button type="submit" class="ml-2" @click.native="submit" :class="{ 'opacity-25': editForm.processing }" :disabled="editForm.processing">
                Zapisz
            </jet-danger-button>
        </template>
    </jet-confirmation-modal>
</template>

<script>
import PetItem from './PetItem'
import JetLabel from '@/Jetstream/Label.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'


export default {
    props: ['pets'],
    emits: ['deletePet'],
    components: {
        PetItem,
        JetLabel,
        JetInput,
        JetInputError,
        JetFormSection,
        JetDangerButton,
        JetSecondaryButton,
        JetConfirmationModal,
    },
    data() {
        return {
            editMode: false,
            deleteForm: this.$inertia.form({
                pets: this.pets
            }),
            editForm: this.$inertia.form({
                _method: 'PUT',
                name: this.name,
                age: this.age,
                race: this.race,
            }),
            editPetId: null,
            showPetEditForm: false,
        }
    },
    methods: {
        deletePet(pet) {
            this.deleteForm.delete(this.route('pets.destroy', pet),{
                preserveScroll: true,
                onSuccess:() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Pet has successfully been deleted!'
                    });
                    this.$emit('deletePet');
                },
                onError:() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    })
                }
            })
        },

        submit() {
            this.editForm.put(this.route('pets.update', this.editPetId), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Your pet has successfully been updated!',
                    });
                    this.editForm.name = null;
                    this.editForm.race = null;
                    this.editForm.age = null;
                    this.showPetEditForm = false;
                },
                onError: () => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    });
                }
            })
        },

        handleShowPetEditForm(id, key) {
            var pet = this.pets[key];

            this.editForm.name = pet.name;
            this.editForm.race = pet.race;
            this.editForm.age = pet.age;

            this.editPetId = id;
            this.showPetEditForm = true;
        },

        handleHidePetAddForm() {
            this.editForm.name = null;
            this.editForm.race = null;
            this.editForm.age = null;

            this.editPetId = null;
            this.showPetEditForm = false;
        }
    }
}
</script>
