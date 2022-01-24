<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="profile.profile_photo_url" :alt="profile.username"
                         class="h-20 w-20 rounded-full object-cover">
                    <span class="capitalize m1-3">
                        {{ `${profile.username}'s Profile` }}
                    </span>

                    <div class="flex-row">
                        {{ `${profile.email}` }}
                    </div>
                </h2>
            </div>
        </template>
    </pages-layout>
</template>

<script>
    import PagesLayout from '@/Layouts/PagesLayout'
    export default {
        props: ['profile'],
        components: {
            PagesLayout,
        }
    }
</script>
