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
                                    Pet name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                    Service Type
                                </th>
                                <th v-if="$page.props.user.role == 'ROLE_ADMIN'" scope="col" class="px-6 py-3 text-left text-xxs md:text-xs lg:text-sm font-medium text-gray-500 uppercase tracking-wider sm:text-xxs">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="(service, key) in services" :key="key">
                                <td class="px-6 py-4 whitespace-nowrap text-xxs md:text-xs lg:text-sm">
                                    {{ service.pet_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xxs md:text-xs lg:text-sm">
                                    {{ service.service_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xxs md:text-xs lg:text-sm">
                                    {{ service.service_type }}
                                </td>
                                <td v-if="$page.props.user.role == 'ROLE_ADMIN'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-xxs md:text-xs lg:text-sm">
                                    <form @submit.prevent="deleteService(service.id)">
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
</template>

<script>
import PetItem from '@/Components/Pets/PetItem'
import ServiceItem from './ServiceItem'
import JetLabel from '@/Jetstream/Label.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'


export default {
    props: ['pets', 'services'],
    emits: ['deleteService'],
    components: {
        PetItem,
        ServiceItem,
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
            deleteForm: this.$inertia.form({
                services: this.services
            }),
        }
    },
    methods: {
        deleteService(service) {
            this.deleteForm.delete(this.route('admin.destroy', service), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Service has successfully been deleted!'
                    });
                    this.$emit('deleteService');
                },
                onError: () => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    })
                }
            })
        },
    }
}
</script>
