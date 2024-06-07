# Utilisez une image de base contenant PHP
FROM php:7.4-apache

# Copiez les fichiers de votre application dans le conteneur
COPY . /var/www/html

# Installez les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Définissez le répertoire de travail
WORKDIR /var/www/html

# Exposez le port 80 pour accéder à l'application
EXPOSE 80

# Démarrez le serveur Apache
CMD ["apache2-foreground"]