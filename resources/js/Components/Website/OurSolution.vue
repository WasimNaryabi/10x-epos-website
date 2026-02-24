<template>
    <section class="solution-section">
        <div class="container">
            <!-- Section Title -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">We Built the Solution</h2>
                <p class="section-description">
                    We designed a platform based on real operational experience, not guesswork. 
                    Then we brought in a strong team of engineers and technology specialists to turn 
                    that experience into a reliable, modern EPOS system that actually works the way businesses need it to.
                </p>
            </div>

            <!-- Solution Points -->
            <div class="solution-grid">
                <div 
                    v-for="(point, index) in solutionPoints" 
                    :key="index"
                    class="solution-card"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <div class="solution-icon">
                        <Icon :name="point.icon" :size="36" color="white" />
                    </div>
                    <h3 class="solution-title">{{ point.title }}</h3>
                    <p class="solution-description">{{ point.description }}</p>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="solution-cta" data-aos="fade-up">
                <button @click="$emit('request-demo')" class="btn-primary">
                    See It In Action
                    <Icon name="arrow-right" :size="20" color="white" />
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo']);

const solutionPoints = ref([
    {
        icon: 'users',
        title: 'Built on Real Experience',
        description: 'Every feature comes from years of hands-on operational knowledge in real restaurants.'
    },
    {
        icon: 'settings',
        title: 'Expert Engineering',
        description: 'Top technology specialists bringing the vision to life with modern, reliable systems.'
    },
    {
        icon: 'target',
        title: 'Operator-Focused',
        description: 'Designed to simplify, not complicate your daily work and operations.'
    },
    {
        icon: 'check',
        title: 'Constantly Evolving',
        description: 'We improve based on real feedback from real operators every single day.'
    }
]);
</script>

<style scoped>
.solution-section {
    padding: 7rem 2rem;
    background: white;
}

.container {
    max-width: 1200px;
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
    margin-bottom: 2rem;
}

.section-description {
    font-size: clamp(1rem, 1.5vw, 1.2rem);
    line-height: 1.9;
    color: #64748b;
    max-width: 900px;
    margin: 0 auto;
}

.solution-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2.5rem;
    margin-bottom: 4rem;
}

.solution-card {
    background: #f8fafc;
    padding: 3rem;
    border-radius: 25px;
    transition: all 0.4s ease;
}

.solution-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(26, 11, 94, 0.15);
}

.solution-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
}

.solution-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1rem;
}

.solution-description {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #64748b;
}

.solution-cta {
    text-align: center;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.2rem 2.5rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(88, 66, 195, 0.4);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(88, 66, 195, 0.5);
}

@media (max-width: 768px) {
    .solution-section {
        padding: 4rem 1.5rem;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .solution-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .solution-card {
        padding: 2.5rem;
    }
}
</style>