<template>
    <div class="icons-preview">
        <h1>All 45+ SVG Icons Preview</h1>
        
        <div v-for="category in iconCategories" :key="category.name" class="category">
            <h2>{{ category.name }}</h2>
            <div class="icons-grid">
                <div v-for="icon in category.icons" :key="icon" class="icon-item">
                    <div class="icon-box">
                        <Icon :name="icon" :size="32" color="#667eea" />
                    </div>
                    <span class="icon-name">{{ icon }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

const iconCategories = ref([
    {
        name: '🏪 POS & Payment',
        icons: ['cash-register', 'credit-card', 'payment', 'receipt']
    },
    {
        name: '👨‍🍳 Kitchen & Food',
        icons: ['kitchen', 'chef-hat', 'utensils', 'food-tray']
    },
    {
        name: '📦 Inventory',
        icons: ['boxes', 'inventory', 'warehouse', 'package']
    },
    {
        name: '📊 Analytics',
        icons: ['chart-line', 'analytics', 'bar-chart', 'pie-chart']
    },
    {
        name: '👥 Users & Staff',
        icons: ['users', 'user-group', 'team', 'staff', 'customer']
    },
    {
        name: '🍽️ Restaurant',
        icons: ['table', 'restaurant', 'dining', 'reservation']
    },
    {
        name: '📱 Devices',
        icons: ['mobile', 'tablet', 'laptop', 'devices']
    },
    {
        name: '💬 Support',
        icons: ['support', 'headset', 'chat']
    },
    {
        name: '✅ UI Elements',
        icons: ['check', 'star', 'calendar', 'clock', 'settings', 'menu', 'close', 'arrow-right', 'arrow-left', 'chevron-down', 'chevron-up']
    },
    {
        name: '📞 Contact',
        icons: ['email', 'phone', 'location']
    },
    {
        name: '📱 Social Media',
        icons: ['facebook', 'twitter', 'linkedin', 'instagram', 'youtube']
    },
    {
        name: '🚀 Features',
        icons: ['rocket', 'lightning', 'shield', 'badge', 'trophy', 'target']
    }
]);
</script>

<style scoped>
.icons-preview {
    padding: 3rem 2rem;
    max-width: 1400px;
    margin: 0 auto;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 3rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.category {
    margin-bottom: 3rem;
}

h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #0f172a;
}

.icons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1.5rem;
}

.icon-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
}

.icon-box {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
}

.icon-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.icon-name {
    font-size: 0.75rem;
    color: #64748b;
    text-align: center;
    font-weight: 500;
}

@media (max-width: 768px) {
    .icons-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 1rem;
    }

    .icon-box {
        width: 60px;
        height: 60px;
    }

    h1 {
        font-size: 2rem;
    }
}
</style>