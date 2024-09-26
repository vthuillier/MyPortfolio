# Étape 1 : Construire l'application Angular
FROM node:alpine AS build

WORKDIR /app

COPY package.json ./
COPY package-lock.json ./
RUN npm install -g @angular/cli
RUN npm install

COPY . .
RUN npm run build

FROM nginx:alpine

COPY --from=build /app/dist/my-portfolio/browser /usr/share/nginx/html
COPY default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
