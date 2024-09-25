# Étape 1 : Construire l'application Angular
FROM node:alpine AS build

WORKDIR /app

COPY package.json ./
COPY package-lock.json ./
RUN npm install -g @angular/cli
RUN npm install

COPY . .
RUN npm run build

# Étape 2 : Serveur Nginx pour les fichiers statiques
FROM nginx:alpine

# Copier les fichiers de build Angular dans le dossier par défaut d'Nginx
COPY --from=build /app/dist/my-portfolio/browser /usr/share/nginx/html

# Optionnel : Configurer un fichier nginx.conf personnalisé si besoin
# COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
