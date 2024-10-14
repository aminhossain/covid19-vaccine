# Use official Node image
FROM node:20-alpine

# Set working directory
WORKDIR /usr/src/app

# Install dependencies
COPY package*.json ./
RUN npm install

# Copy the rest of the application
COPY . .

# Expose port 3000 for the React app
EXPOSE 3000

# Start the React application
CMD ["npm", "start"]
