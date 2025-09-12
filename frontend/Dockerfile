FROM node:20-alpine

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

# Собираем production-бандл
RUN npm run build

CMD ["sh", "-c", "echo 'Frontend built in /app/dist' && tail -f /dev/null"]

