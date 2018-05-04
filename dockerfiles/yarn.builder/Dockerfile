FROM alpine:3.7

RUN apk add --no-cache yarn

WORKDIR /usr/share/nginx/html

CMD ls -al ./ \
    && yarn install \
    && yarn run encore production