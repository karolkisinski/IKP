<template>
<!--    <Head title="Welcome" />-->
    <div class="flex justify-around items-center bg-gray-100 min-h-screen">
        <div>
            <img :src="'/storage/images/foot.webp'" alt="IPK">
        </div>
        <div class="text-center">
            <h1 class="text-4xl font-semibold">
                Internetowe Konto Pacjencika
            </h1>

            <div v-if="canLogin" class="flex justify-center space-x-6 mt-5">
                <Link :href="route('dashboard')" v-if="$page.props.user" class="text-lg text-gray-700">
                    Dashboard
                </Link>
                <template v-else>
                    <Link :href="route('login')" class="text-white bg-gray-800 rounded px-3 py-1 hover:bg-gray-500">Login</Link>
                    <Link :href="route('register')" class="text-white bg-gray-800 rounded px-3 py-1 hover:bg-gray-500">Register</Link>
                </template>
            </div>
            <p class="mt-10">{{ users }} active members</p>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            users: Number,
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    })
</script>
