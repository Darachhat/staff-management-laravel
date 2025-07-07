import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Dashboard data and interactions
Alpine.data('dashboard', () => ({
    loading: false,
    refreshing: false,
    stats: {
        totalEmployees: 0,
        presentToday: 0,
        lateToday: 0,
        pendingLeaves: 0
    },
    
    init() {
        this.animateStats();
        this.startPeriodicRefresh();
    },
    
    animateStats() {
        // Animate counting up for statistics
        const elements = document.querySelectorAll('.stat-number');
        elements.forEach(el => {
            const finalValue = parseInt(el.textContent);
            let currentValue = 0;
            const increment = finalValue / 20;
            
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    currentValue = finalValue;
                    clearInterval(timer);
                }
                el.textContent = Math.floor(currentValue);
            }, 50);
        });
    },
    
    async refreshStats() {
        if (this.refreshing) return;
        
        this.refreshing = true;
        
        try {
            // Simulate API call - in real implementation, this would fetch from backend
            await new Promise(resolve => setTimeout(resolve, 1000));
            
            // Animation for refresh
            this.animateStats();
        } catch (error) {
            console.error('Error refreshing stats:', error);
        } finally {
            this.refreshing = false;
        }
    },
    
    startPeriodicRefresh() {
        // Refresh stats every 5 minutes
        setInterval(() => {
            this.refreshStats();
        }, 300000);
    }
}));

// Card hover effects
Alpine.data('cardHover', () => ({
    hovered: false,
    
    enter() {
        this.hovered = true;
    },
    
    leave() {
        this.hovered = false;
    }
}));

// Loading states
Alpine.data('loadingState', () => ({
    loading: true,
    
    init() {
        // Simulate initial loading
        setTimeout(() => {
            this.loading = false;
        }, 800);
    }
}));

Alpine.start();
