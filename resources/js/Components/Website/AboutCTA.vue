<template>
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2 class="cta-title">Join Us on This Journey</h2>
                <p class="cta-description">
                    Experience the difference that operator-built technology can make. 
                    Start your free trial today and see why thousands of restaurants trust 10x Global.
                </p>

                <div class="cta-buttons">
                    <button @click="$emit('request-demo')" class="btn-primary">
                        Start Free Trial
                        <Icon name="arrow-right" :size="20" color="white" />
                    </button>
                    <button @click="$emit('contact-sales')" class="btn-secondary">
                        Contact Sales
                        <Icon name="message-circle" :size="20" color="#1a0b5e" />
                    </button>
                </div>

                <!-- Trust Indicators -->
                <div class="trust-indicators" data-aos="fade-up" data-aos-delay="200">
                    <div 
                        v-for="(indicator, index) in trustIndicators" 
                        :key="index"
                        class="indicator"
                    >
                        <span class="indicator-value">{{ indicator.value }}</span>
                        <span class="indicator-label">{{ indicator.label }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo', 'contact-sales']);

const trustIndicators = ref([
    // { value: '10,000+', label: 'Active Users' },
    { value: '99.9%', label: 'Uptime' },
    { value: '24/7', label: 'Support' }
]);
</script>

<style scoped>
.cta-section {
    padding: 7rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.container {
    max-width: 900px;
    margin: 0 auto;
}

.cta-content {
    text-align: center;
}

.cta-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1.5rem;
}

.cta-description {
    font-size: clamp(1rem, 1.8vw, 1.25rem);
    line-height: 1.8;
    color: #64748b;
    margin-bottom: 3rem;
}

.cta-buttons {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 4rem;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.2rem 2.5rem;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    box-shadow: 0 4px 20px rgba(88, 66, 195, 0.4);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(88, 66, 195, 0.5);
}

.btn-secondary {
    background: white;
    color: #1a0b5e;
    border: 2px solid #1a0b5e;
}

.btn-secondary:hover {
    background: #1a0b5e;
    color: white;
}

.trust-indicators {
    display: flex;
    justify-content: center;
    gap: 4rem;
    flex-wrap: wrap;
}

.indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.indicator-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1a0b5e;
}

.indicator-label {
    font-size: 1rem;
    color: #64748b;
    font-weight: 500;
}

@media (max-width: 768px) {
    .cta-section {
        padding: 4rem 1.5rem;
    }

    .cta-buttons {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-primary,
    .btn-secondary {
        width: 100%;
        justify-content: center;
    }

    .trust-indicators {
        gap: 2rem;
    }

    .indicator-value {
        font-size: 2rem;
    }
}
</style>