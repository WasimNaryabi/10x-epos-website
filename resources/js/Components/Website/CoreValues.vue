<template>
    <section class="values-section">
        <div class="container">
            <!-- Section Title -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">What Drives Us</h2>
                <p class="section-subtitle">The principles behind everything we build</p>
            </div>

            <!-- Values Grid -->
            <div class="values-grid">
                <div 
                    v-for="(value, index) in values" 
                    :key="index"
                    class="value-card"
                    data-aos="zoom-in"
                    :data-aos-delay="index * 100"
                >
                    <div class="value-icon">{{ value.icon }}</div>
                    <h3 class="value-title">{{ value.title }}</h3>
                    <p class="value-description">{{ value.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const values = ref([
    {
        icon: '👥',
        title: 'Operator First',
        description: 'Every decision we make starts with one question: Does this help operators operate better?'
    },
    {
        icon: '💡',
        title: 'Real World Focus',
        description: 'We build for real businesses facing real challenges, not theoretical situations.'
    },
    {
        icon: '🚀',
        title: 'Continuous Innovation',
        description: 'We stay ahead of industry changes to bring you tomorrow\'s solutions today.'
    },
    {
        icon: '🤝',
        title: 'True Partnership',
        description: 'Your success is our success. We\'re in this together, for the long term.'
    }
]);
</script>

<style scoped>
.values-section {
    padding: 7rem 2rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 3rem;
}

.value-card {
    text-align: center;
    padding: 2rem;
}

.value-icon {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
}

.value-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.value-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.95);
}

@media (max-width: 768px) {
    .values-section {
        padding: 4rem 1.5rem;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .values-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .value-card {
        padding: 1.5rem;
    }
}
</style>