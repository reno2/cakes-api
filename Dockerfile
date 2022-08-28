FROM node:12.16.3-alpine3.9

#RUN mkdir -p /var/www/dockerize-nuxt/nuxt-app
#WORKDIR /var/www/dockerize-nuxt/nuxt-app
#
##COPY ./frontend/package*.json ./
#
#RUN npm install
#
#
#COPY ./frontend .
#
#RUN npm run build
#
#EXPOSE 4000
#
#ENV NUXT_HOST=0.0.0.0
#
#ENV NUXT_PORT=4000
#
#CMD [ "npm", "dev" ]

#RUN yarn global add pm2 --prefix /usr/local

#CMD ["pm2", "--no-daemon"]
#CMD pm2 start -i max --no-daemon --interpreter bash yarn --name front -- start
#CMD pm2 start --env development --no-daemon
