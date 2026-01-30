<template>
    <section id="features" class="features-section">
        <div class="features-container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Features</span>
                <h2 class="section-title">Everything your business needs in one place</h2>
                <p class="section-subtitle">
                    Powerful features designed specifically for cafes and restaurants. 
                    Streamline operations, increase efficiency, and boost profitability.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="features-grid">
                <!-- Feature Card -->
                <div 
                    v-for="(feature, index) in features" 
                    :key="index"
                    class="feature-card"
                    :data-aos="index % 2 === 0 ? 'fade-right' : 'fade-left'"
                    :data-aos-delay="index * 100"
                >
                    <div class="feature-icon" :style="{ background: feature.gradient }">
                        <Icon :name="feature.icon" :size="32" color="white" />
                    </div>
                    <h3 class="feature-title">{{ feature.title }}</h3>
                    <p class="feature-description">{{ feature.description }}</p>
                    <ul class="feature-list">
                        <li v-for="(item, i) in feature.items" :key="i">
                            <Icon name="check" :size="14" color="#10b981" />
                            {{ item }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="features-cta" data-aos="fade-up">
                <h3>Ready to 10x your business?</h3>
                <p>Join 50+ restaurants already using 10x Global EPOS</p>
                <button @click="$emit('request-demo')" class="cta-button">
                    <Icon name="calendar" :size="20" color="currentColor" />
                    Request a free 30 min consultation
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo']);

const features = ref([
    {
        icon: 'cash-register',
        title: 'Point of Sale',
        gradient: 'linear-gradient(135deg, #667eea, #764ba2)',
        description: 'Fast, intuitive POS system designed for busy restaurants',
        items: [
            'Touch-optimized interface',
            'Quick order entry',
            'Split bills & table management',
            'Multiple payment methods',
            'Offline mode capability'
        ]
    },
    {
        icon: 'kitchen',
        title: 'Kitchen Order Tickets',
        gradient: 'linear-gradient(135deg, #f093fb, #f5576c)',
        description: 'Streamline kitchen operations with digital KOT system',
        items: [
            'Real-time order transmission',
            'Kitchen display system',
            'Order priority management',
            'Prep time tracking',
            'Multi-station routing'
        ]
    },
    {
        icon: 'boxes',
        title: 'Inventory Management',
        gradient: 'linear-gradient(135deg, #4facfe, #00f2fe)',
        description: 'Track stock levels and reduce waste efficiently',
        items: [
            'Real-time stock tracking',
            'Low stock alerts',
            'Recipe management',
            'Supplier management',
            'Waste tracking'
        ]
    },
    {
        icon: 'chart-line',
        title: 'Advanced Reporting',
        gradient: 'linear-gradient(135deg, #43e97b, #38f9d7)',
        description: 'Make data-driven decisions with comprehensive analytics',
        items: [
            'Sales reports & trends',
            'Staff performance tracking',
            'Best-selling items analysis',
            'Profit margin reports',
            'Custom report builder'
        ]
    },
    {
        icon: 'users',
        title: 'Staff Management',
        gradient: 'linear-gradient(135deg, #fa709a, #fee140)',
        description: 'Manage your team efficiently with built-in tools',
        items: [
            'Employee scheduling',
            'Time clock & attendance',
            'Role-based permissions',
            'Commission tracking',
            'Performance metrics'
        ]
    },
    {
        icon: 'table',
        title: 'Table Management',
        gradient: 'linear-gradient(135deg, #30cfd0, #330867)',
        description: 'Optimize seating and improve table turnover',
        items: [
            'Interactive floor plan',
            'Table status tracking',
            'Reservation management',
            'Waitlist system',
            'Table merging & splitting'
        ]
    },
    {
        icon: 'customer',
        title: 'Customer Management',
        gradient: 'linear-gradient(135deg, #a8edea, #fed6e3)',
        description: 'Build lasting relationships with your customers',
        items: [
            'Customer database',
            'Loyalty programs',
            'Order history tracking',
            'Feedback collection',
            'Marketing campaigns'
        ]
    },
    {
        icon: 'credit-card',
        title: 'Payment Processing',
        gradient: 'linear-gradient(135deg, #ff9a9e, #fecfef)',
        description: 'Accept all payment methods securely',
        items: [
            'Card payments (Chip & Pin)',
            'Contactless payments',
            'Mobile wallet support',
            'Split payments',
            'Integrated receipts'
        ]
    },
    {
        icon: 'mobile',
        title: 'Multi-Platform',
        gradient: 'linear-gradient(135deg, #ffecd2, #fcb69f)',
        description: 'Access your business from anywhere, anytime',
        items: [
            'Cloud-based system',
            'Mobile app support',
            'Tablet compatibility',
            'Remote management',
            'Auto-sync across devices'
        ]
    }
]);
</script>

<style scoped>
.features-section {
    padding: 6rem 2rem;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
}

.features-container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.feature-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #e2e8f0;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.feature-icon {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    color: white;
    font-size: 1.75rem;
}

.feature-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1rem;
}

.feature-description {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.feature-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.feature-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    color: #334155;
    font-size: 0.95rem;
}

.feature-list li i {
    color: #10b981;
    font-size: 0.875rem;
}

.features-cta {
    text-align: center;
    padding: 3rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    border-radius: 20px;
    color: white;
}

.features-cta h3 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
}

.features-cta p {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    opacity: 0.95;
}

.cta-button {
    padding: 1rem 2.5rem;
    background: white;
    color: #667eea;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
}

@media (max-width: 768px) {
    .features-section {
        padding: 4rem 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }

    .features-cta h3 {
        font-size: 1.5rem;
    }
}
</style>