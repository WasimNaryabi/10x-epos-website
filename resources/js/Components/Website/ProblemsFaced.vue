<template>
    <section class="problems-section">
        <div class="container">
            <!-- Section Title -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">The Problems We Faced</h2>
                <p class="section-subtitle">Challenges every operator knows too well</p>
            </div>

            <!-- Problems Grid -->
            <div class="problems-grid">
                <div 
                    v-for="(problem, index) in problems" 
                    :key="index"
                    class="problem-card"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <div class="problem-icon">
                        <Icon :name="problem.icon" :size="32" color="white" />
                    </div>
                    <h3 class="problem-title">{{ problem.title }}</h3>
                    <p class="problem-description">{{ problem.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

const problems = ref([
    {
        icon: 'check',
        title: "Systems That Can't Adapt",
        description: 'Rigid, inflexible software that forces you to change your operations instead of adapting to your needs.'
    },
    {
        icon: 'headset',
        title: 'Out of Touch Support',
        description: "Support teams that don't understand the pressure of a busy service or the unique challenges of hospitality."
    },
    {
        icon: 'clock',
        title: 'Unnecessary Complexity',
        description: 'Tools that create more work instead of simplifying operations, especially during the busiest times.'
    }
]);
</script>

<style scoped>
.problems-section {
    padding: 7rem 2rem;
    background: #f8fafc;
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
    color: #0f172a;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: #64748b;
    font-weight: 500;
}

.problems-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2.5rem;
}

.problem-card {
    background: white;
    padding: 3rem;
    border-radius: 25px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.4s ease;
}

.problem-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(239, 68, 68, 0.15);
}

.problem-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
}

.problem-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1rem;
}

.problem-description {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #64748b;
}

@media (max-width: 768px) {
    .problems-section {
        padding: 4rem 1.5rem;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .problems-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .problem-card {
        padding: 2.5rem;
    }
}
</style>