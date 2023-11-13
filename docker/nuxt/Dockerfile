# syntax = docker/dockerfile:1

ARG NODE_VERSION=18.14.2

FROM node:${NODE_VERSION}-slim as base

ENV NODE_ENV=development

WORKDIR /src

# Build
FROM base as build
RUN yarn install

# Run
FROM base

EXPOSE 3000
EXPOSE 24678

CMD [ "yarn", "run", "dev" ]
