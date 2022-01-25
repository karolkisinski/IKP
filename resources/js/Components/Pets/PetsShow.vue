
<template>
    <div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Race
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Age
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Delete</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="(pet, key) in pets" :key="key">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ pet.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ pet.race }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ pet.age }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form @submit.prevent="deletePet">
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>


                            <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PetItem from './PetItem'
export default {
    props: ['pets'],
    components: {
        PetItem,
    },
    data() {
        return {
            deleteForm: this.$inertia.form({
                pets: this.pets
            })
        }
    },
    methods: {
        deletePet() {
            this.deleteForm.delete(this.route('pets.destroy', this.pets),{
                preserveScroll: true,
                onSuccess:()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Pet has successfully been deleted!'
                    })
                },
                onError:()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    })
                }
            })
        }
    }
}
</script>
