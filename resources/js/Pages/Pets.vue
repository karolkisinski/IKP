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
        <form @submit.prevent="submit" class="w-full">
            <div>
                <input name="name" class="flex border rounded px-2 py-2 w-25" placeholder="Add your pet name" v-model="form.name">
                <div>
                    <jet-input-error :message="form.errors.name" class="mt-2" v-if="form.errors.name"></jet-input-error>
                </div>
                <input name="race" class="flex border rounded px-2 py-2 w-25" placeholder="Add your pet race" v-model="form.race">
                <div>
                    <jet-input-error :message="form.errors.race" class="mt-2" v-if="form.errors.race"></jet-input-error>
                </div>
                <input name="age" type="number" class="flex border rounded px-2 py-2 w-25" placeholder="Add your pet age" v-model="form.age">
                <div>
                    <jet-input-error :message="form.errors.age" class="mt-2" v-if="form.errors.age"></jet-input-error>
                </div>
            </div>
            <div>
                <button type="submit" class="text-xs">Send</button>
            </div>
        </form>
        <pets :pets="pets">

        </pets>
    </pages-layout>
</template>

<script>
import { defineComponent } from 'vue'
import PagesLayout from '@/Layouts/PagesLayout.vue'
import Pets from '@/Components/Pets/PetsShow'
import JetInputError from '@/Jetstream/InputError'


export default defineComponent({
    props: ['pets'],
    components: {
        PagesLayout,
        Pets,
        JetInputError,
    },
    data() {
        return {
            form: this.$inertia.form({
                user_id: this.$page.props.user.id,
                name: this.name,
                race: this.race,
                age: this.age,
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('pets.store'), {
                preserveScroll: true,
                onSuccess:()=> {
                    Toast.fire({
                        icon: 'success',
                        title: 'Your pet has successfully been added!',
                    }),
                        this.form.body = null
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
});
</script>
