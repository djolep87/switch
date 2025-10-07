#!/bin/bash

# Performance Monitoring Script for Laravel Application
# This script monitors system resources during load testing

echo "🚀 Starting Performance Monitoring for Laravel Application"
echo "=================================================="

# Function to get current timestamp
timestamp() {
    date '+%Y-%m-%d %H:%M:%S'
}

# Function to monitor system resources
monitor_resources() {
    echo "📊 System Resources at $(timestamp)"
    echo "----------------------------------------"
    
    # CPU Usage
    echo "💻 CPU Usage:"
    top -l 1 | grep "CPU usage" || top -bn1 | grep "Cpu(s)"
    
    # Memory Usage
    echo -e "\n🧠 Memory Usage:"
    free -h 2>/dev/null || vm_stat | head -10
    
    # Disk Usage
    echo -e "\n💾 Disk Usage:"
    df -h | grep -E "(Filesystem|/dev/)"
    
    # Network Connections
    echo -e "\n🌐 Network Connections:"
    netstat -an | grep :80 | wc -l | xargs echo "Active connections on port 80:"
    netstat -an | grep :443 | wc -l | xargs echo "Active connections on port 443:"
    
    # MySQL Process List (if available)
    echo -e "\n🗄️ Database Connections:"
    mysqladmin processlist 2>/dev/null | wc -l | xargs echo "MySQL connections:" || echo "MySQL not accessible"
    
    # Apache/PHP-FPM Processes
    echo -e "\n⚡ Web Server Processes:"
    ps aux | grep -E "(apache|httpd|php-fpm)" | grep -v grep | wc -l | xargs echo "Web server processes:"
    
    echo -e "\n" 
}

# Function to test response times
test_response_time() {
    local url=$1
    local name=$2
    
    echo "⏱️ Testing response time for $name:"
    if command -v curl &> /dev/null; then
        response_time=$(curl -o /dev/null -s -w '%{time_total}' "$url" 2>/dev/null)
        if [ $? -eq 0 ]; then
            echo "   Response time: ${response_time}s"
        else
            echo "   ❌ Failed to connect"
        fi
    else
        echo "   ❌ curl not available"
    fi
}

# Function to check Laravel application health
check_laravel_health() {
    echo "🔍 Laravel Application Health Check at $(timestamp)"
    echo "------------------------------------------------"
    
    # Check if Laravel is running
    if [ -f "artisan" ]; then
        echo "✅ Laravel application found"
        
        # Check Laravel routes
        echo "🛣️ Checking key routes:"
        test_response_time "http://127.0.0.1:8000/" "Home page"
        test_response_time "http://127.0.0.1:8000/login" "Login page"
        test_response_time "http://127.0.0.1:8000/register" "Register page"
        
        # Check database connection
        echo -e "\n🗄️ Database Health:"
        php artisan migrate:status 2>/dev/null | head -5 || echo "❌ Database connection failed"
        
        # Check cache
        echo -e "\n💾 Cache Health:"
        php artisan cache:clear 2>/dev/null && echo "✅ Cache cleared successfully" || echo "❌ Cache clear failed"
        
    else
        echo "❌ Laravel application not found in current directory"
    fi
    echo -e "\n"
}

# Function to run Apache Bench test
run_ab_test() {
    local url=$1
    local requests=$2
    local concurrency=$3
    local name=$4
    
    echo "🧪 Running Apache Bench test: $name"
    echo "URL: $url"
    echo "Requests: $requests, Concurrency: $concurrency"
    echo "----------------------------------------"
    
    if command -v ab &> /dev/null; then
        ab -n $requests -c $concurrency "$url" 2>/dev/null | grep -E "(Time per request|Requests per second|Failed requests|Complete requests)"
    else
        echo "❌ Apache Bench (ab) not installed"
        echo "Install with: brew install httpd (macOS) or apt-get install apache2-utils (Ubuntu)"
    fi
    echo -e "\n"
}

# Main monitoring loop
echo "Starting continuous monitoring..."
echo "Press Ctrl+C to stop"
echo ""

# Initial health check
check_laravel_health

# Continuous monitoring
while true; do
    monitor_resources
    
    # Run quick response time tests every 30 seconds
    test_response_time "http://127.0.0.1:8000/" "Home page"
    
    sleep 30
done

# Cleanup function
cleanup() {
    echo -e "\n🛑 Monitoring stopped at $(timestamp)"
    echo "Final system check:"
    monitor_resources
    exit 0
}

# Trap Ctrl+C
trap cleanup INT

# Keep script running
wait


