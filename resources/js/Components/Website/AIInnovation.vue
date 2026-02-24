<template>
    <section class="ai-section">
        <div class="container">
            <div class="ai-content">
                <!-- Left Content -->
                <div class="ai-text" data-aos="fade-right">
                    <h2 class="ai-title">Leading the AI Revolution</h2>
                    <p class="ai-description">
                        As the world of technology evolves, we want to support operators in using AI in practical, 
                        meaningful ways. Our mission is to help lead the next wave of innovation and bring AI-powered 
                        operations into hospitality, changing the industry for the better.
                    </p>

                    <div class="ai-features">
                        <div 
                            v-for="(feature, index) in aiFeatures" 
                            :key="index"
                            class="ai-feature"
                        >
                            <div class="feature-icon">
                                <Icon :name="feature.icon" :size="24" color="#1a0b5e" />
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">{{ feature.title }}</h4>
                                <p class="feature-description">{{ feature.description }}</p>
                            </div>
                        </div>
                    </div>

                    <button @click="$emit('request-demo')" class="btn-primary">
                        Experience AI-Powered EPOS
                        <Icon name="arrow-right" :size="20" color="white" />
                    </button>
                </div>

                <!-- Right Image -->
                <div class="ai-image" data-aos="fade-left">
                    <div class="ai-visual">
                        <div class="visual-icon">🤖</div>
                        <p class="visual-text">AI Powered Future</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo']);

const aiFeatures = ref([
    {
        icon: 'zap',
        title: 'Practical AI',
        description: 'Real solutions, not gimmicks – AI that solves actual problems'
    },
    {
        icon: 'trending-up',
        title: 'Meaningful Impact',
        description: 'Technology that makes a measurable difference to your operations'
    },
    {
        icon: 'award',
        title: 'Industry Leadership',
        description: 'Pioneering the future of hospitality technology'
    },
    {
        icon: 'user-check',
        title: 'Operator Focused',
        description: 'AI that works for you, not the other way around'
    }
]);
</script>

<style scoped>
.ai-section {
    padding: 7rem 2rem;
    background: white;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

.ai-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
}

.ai-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 2rem;
}

.ai-description {
    font-size: clamp(1rem, 1.5vw, 1.2rem);
    line-height: 1.9;
    color: #64748b;
    margin-bottom: 3rem;
}

.ai-features {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.ai-feature {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.ai-feature:hover {
    background: #e2e8f0;
    transform: translateX(10px);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.feature-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.feature-description {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
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

.ai-image {
    display: flex;
    align-items: center;
    justify-content: center;
}

.ai-visual {
    background: linear-gradient(135deg, #667eea, #764ba2);
    padding: 5rem 4rem;
    border-radius: 30px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
}

.visual-icon {
    font-size: 6rem;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
}

.visual-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
}

@media (max-width: 968px) {
    .ai-section {
        padding: 4rem 1.5rem;
    }

    .ai-content {
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .ai-visual {
        padding: 4rem 3rem;
    }
}
</style>