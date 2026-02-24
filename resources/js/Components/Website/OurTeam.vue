<template>
    <section class="team-section">
        <div class="container">
            <!-- Section Title -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Who We Are</h2>
                <p class="section-subtitle">A team of operators and engineers united by one goal</p>
            </div>

            <!-- Team Grid -->
            <div class="team-grid">
                <div 
                    v-for="(member, index) in teamMembers" 
                    :key="index"
                    class="team-card"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <div class="team-icon">{{ member.icon }}</div>
                    <h3 class="team-role">{{ member.role }}</h3>
                    <p class="team-label">{{ member.label }}</p>
                    <p class="team-description">{{ member.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const teamMembers = ref([
    {
        icon: '🏪',
        role: 'Operators',
        label: 'Real Experience',
        description: 'Years of hands-on experience running cafes, restaurants, and food businesses in high-pressure environments.'
    },
    {
        icon: '💻',
        role: 'Engineers',
        label: 'Technical Excellence',
        description: 'Top technology specialists building reliable, modern systems that work exactly as operators need them to.'
    },
    {
        icon: '🧠',
        role: 'Innovators',
        label: 'Future Forward',
        description: 'Leading the next wave of AI-powered operations to transform hospitality for the better.'
    }
]);
</script>

<style scoped>
.team-section {
    padding: 7rem 2rem;
    background: #f8fafc;
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
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: #64748b;
    font-weight: 500;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 3rem;
}

.team-card {
    background: white;
    padding: 3rem;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.4s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(26, 11, 94, 0.15);
}

.team-icon {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
}

.team-role {
    font-size: 1.75rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.team-label {
    color: #1a0b5e;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.team-description {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #64748b;
}

@media (max-width: 768px) {
    .team-section {
        padding: 4rem 1.5rem;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .team-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .team-card {
        padding: 2.5rem;
    }
}
</style>