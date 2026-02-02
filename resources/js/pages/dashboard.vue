<script setup lang="ts">
    import { trans } from 'laravel-vue-i18n';

    const features = [
        {
            icon: '📝',
            title: trans('app.dashboard.feature.create_quizzes'),
            description: trans('app.dashboard.feature.create_quizzes_description')
        },
        {
            icon: '🎯',
            title: trans('app.dashboard.feature.track_progress'),
            description: trans('app.dashboard.feature.track_progress_description'),
        },
        {
            icon: '⚡',
            title: trans('app.dashboard.feature.take_quizzes'),
            description: trans('app.dashboard.feature.take_quizzes_description')
        },
        {
            icon: '🏆',
            title: trans('app.dashboard.feature.challenge_friends'),
            description: trans('app.dashboard.feature.challenge_friends_description')
        }
    ];
</script>

<template>
    <div>
        <!-- Hero Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-slate-100 mb-4">
                    {{ $t('app.dashboard.welcome') }}
                    <span class="text-green-500" style="text-transform: capitalize;">
                        {{ $page.props.name }}
                    </span>
                </h1>
                <p class="text-xl text-slate-200 mb-8">
                    {{ $t('app.dashboard.welcome_message') }}
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div 
                    v-for="feature in features" 
                    :key="feature.title"
                    class="text-slate-100 bg-slate-700 rounded-xl p-6 shadow-lg hover:shadow-xl transition"
                >
                    <div class="text-5xl mb-4">
                        {{ feature.icon }}
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-2">
                        {{ feature.title }}
                    </h3>
                    <p class="text-slate-200">
                        {{ feature.description }}
                    </p>
                </div>
            </div>

            <!-- How It Works Section -->
            <div class="bg-slate-700 text-slate-200 rounded-2xl shadow-xl p-12">
                <h2 class="text-3xl font-bold text-center text-slate-100 mb-12">
                    {{ $t('app.dashboard.how_it_works.title') }}
                </h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-green-500">1</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $t('app.dashboard.how_it_works.step1_title') }}</h3>
                        <p class="text-slate-300">{{ $t('app.dashboard.how_it_works.step1_description') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-green-500">2</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $t('app.dashboard.how_it_works.step2_title') }}</h3>
                        <p class="text-slate-300">{{ $t('app.dashboard.how_it_works.step2_description') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-green-500">3</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $t('app.dashboard.how_it_works.step3_title') }}</h3>
                        <p class="text-slate-300">{{ $t('app.dashboard.how_it_works.step3_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>