/**
 * V-Shell v2.0 - Tactical Portfolio Terminal
 * Focused on "Woah" factor and recruiter engagement
 */
class VTerminal {
    constructor(elementId) {
        this.container = document.getElementById(elementId);
        this.output = this.container.querySelector('.terminal-output');
        this.input = this.container.querySelector('input');
        this.prefix = '<span class="text-yellow-400 font-bold">visitor@valentin:~$</span>';
        this.isTyping = false;
        
        this.asciiLogo = `
<span class="text-yellow-400">    _   __      _____ _          _ _ 
   | | / /     /  ___| |        | | |
   | |/ /______| \\__ \\ |__   ___| | |
   |    /______|  \\__ \\ '_ \\ / _ \\ | |
   | |\\ \\      |\\__/ / | | |  __/ | |
   \\_| \\_\\     \\____/|_| |_|\\___|_|_|</span>
<span class="text-stone-500">   [ TACTICAL DEVOPS INTERFACE v2.0 ]</span>
        `;

        this.commands = {
            'help': () => this.type([
                'AVAILABLE COMMANDS:',
                '  <span class="text-yellow-400">whoami</span>      - Display identity manifest',
                '  <span class="text-yellow-400">skills</span>      - List technical stack & expertise',
                '  <span class="text-yellow-400">status</span>      - Check system & intervention readiness',
                '  <span class="text-yellow-400">projects</span>    - Open tactical interventions gallery',
                '  <span class="text-yellow-400">emergency</span>   - [REDACTED]',
                '  <span class="text-yellow-400">clear</span>       - Purge terminal buffer'
            ]),
            'whoami': () => {
                this.print(this.asciiLogo);
                this.type([
                    '',
                    'NAME: Valentin Thuillier',
                    'ROLE: DevOps Engineer & Volunteer Firefighter',
                    'SPECIALIZATION: High-Availability, Automation, Crisis Management',
                    'LOCATION: Northern France',
                    '',
                    '// "Combining technical excellence with ground-level reliability."'
                ]);
            },
            'skills': () => this.type([
                'TECHNICAL STACK:',
                '  <span class="text-blue-400">[INFRA]</span>     Kubernetes, Docker, Terraform, Ansible',
                '  <span class="text-green-400">[AUTOMATE]</span>  GitLab CI, GitHub Actions, Jenkins',
                '  <span class="text-purple-400">[CLOUD]</span>     AWS, Azure, GCP',
                '  <span class="text-red-400">[RESCUE]</span>    Advanced First Aid, Leadership under pressure'
            ]),
            'status': () => {
                const isEmergency = document.body.classList.contains('emergency-mode');
                if (isEmergency) {
                    this.type([
                        '<span class="text-red-500 font-bold">!!! EMERGENCY ALERT !!!</span>',
                        'SYSTEM STATE: INTERVENTION ACTIVE',
                        'ALL RESOURCES REDIRECTED TO CRITICAL OPS',
                        'NETWORK STACK: FULL OVERRIDE'
                    ]);
                } else {
                    this.type([
                        'SYSTEM STATE: <span class="text-green-500">OPTIMAL</span>',
                        'UPTIME: 100%',
                        'READINESS: LEVEL 1 (Standby)',
                        'DEVOPS CAPACITY: MAXIMUM'
                    ]);
                }
            },
            'projects': () => {
                this.print('Opening interventions catalog...');
                window.location.hash = '#projects';
            },
            'emergency': () => {
                this.print('<span class="text-red-500 font-bold">COMMENCING SYSTEM OVERRIDE...</span>');
                document.getElementById('panic-button')?.click();
            },
            'clear': () => {
                this.output.innerHTML = '';
            }
        };

        this.init();
    }

    init() {
        this.container.addEventListener('click', () => this.input.focus());
        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !this.isTyping) {
                const cmd = this.input.value.toLowerCase().trim();
                this.handleCommand(cmd);
                this.input.value = '';
            }
        });

        // Trigger boot sequence when visible
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                this.bootSequence();
                observer.disconnect();
            }
        }, { threshold: 0.5 });
        observer.observe(this.container);
    }

    async bootSequence() {
        this.isTyping = true;
        this.input.parentElement.classList.add('hidden');
        
        const bootLines = [
            '<span class="text-stone-500">V-BIOS v4.0.21...</span>',
            'CPU: DEVOPS-CORE i9 // 24 CORES DETECTED',
            'RAM: 64GB // INTERVENTION BUFFER OK',
            'STORAGE: SSD NVME // SECTOR AUTHENTICATED',
            'NET: ESTABLISHING TACTICAL UPLINK...',
            '<span class="text-green-500">CONNECTED.</span>',
            '----------------------------------------',
            'LOADING V-SHELL INTERFACE...',
            '<span class="text-yellow-400">READY.</span>',
            ''
        ];

        for (const line of bootLines) {
            this.print(line);
            await new Promise(r => setTimeout(r, Math.random() * 200 + 50));
            this.container.scrollTop = this.container.scrollHeight;
        }

        this.input.parentElement.classList.remove('hidden');
        this.isTyping = false;
    }

    handleCommand(cmd) {
        this.print(`${this.prefix} ${cmd}`);
        if (cmd === '') return;
        
        if (this.commands[cmd]) {
            this.commands[cmd]();
        } else {
            this.print(`Command not found: ${cmd}. Type <span class="text-yellow-400">help</span> for available missions.`);
        }
        
        this.container.scrollTop = this.container.scrollHeight;
    }

    async type(lines) {
        this.isTyping = true;
        this.input.parentElement.classList.add('hidden');

        for (const line of lines) {
            this.print(line);
            await new Promise(r => setTimeout(r, 100));
            this.container.scrollTop = this.container.scrollHeight;
        }

        this.input.parentElement.classList.remove('hidden');
        this.isTyping = false;
    }


    print(text) {
        const line = document.createElement('div');
        line.className = 'mb-1 whitespace-pre-wrap leading-relaxed';
        line.innerHTML = text;
        this.output.appendChild(line);
    }
}

// Initialize when element is present
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('v-terminal')) {
        new VTerminal('v-terminal');
    }
});
