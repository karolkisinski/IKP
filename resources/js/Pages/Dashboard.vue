<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                    class="h-20 w-20 rounded-full object-cover">
                    <div class="capitalize m1-3">
                        Hello {{ $page.props.user.username }}
                    </div>
                </h2>
            </div>
            <div class="container">
                <div class="flex flex-wrap flex-row-reverse">
                    <div class="bg-green-200">
                        Your pets count
                    </div>
                    <div class="bg-green-200">
                        Your pets count
                    </div>
                    <div class="bg-green-700">
                        Your pets count
                    </div>
                </div>
            </div>
        </template>
    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import PagesLayout from '@/Layouts/PagesLayout.vue'

    export default defineComponent({
        components: {
            PagesLayout,

        },
    })
</script>
