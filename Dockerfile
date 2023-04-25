# FROM alpine:3.13

FROM php:7.2-fpm
LABEL maintainers="Fabian Born" \
      app="Kicker API" \
      description="provide a kicker API"
WORKDIR ./app
RUN mkdir /portal
COPY app/ /portal
# RUN apk add --no-cache bash go git
RUN ls /portal


EXPOSE 8084


