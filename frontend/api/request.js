//import { HTTP_REST } from '~/plugins/axios';
import HTTP_REST from '@nuxtjs/axios';

const request = async function(
  context,
  method,
  path,
  params = {},
  config = {}
) {
  const axios = HTTP_REST(context);

  try {
    const { data = {}, status } = await axios[method](path, params, {
      withCredentials: true,
      ...config
    });

    if (typeof data === 'object') {
      data.status = status;
    }

    return data;
  } catch (error) {
    const status = error.response ? error.response.status : 404;
    const data = error.response ? error.response.data : {};

    if ([404, 500].includes(status)) {
      context.error({ statusCode: status });
    }

    return { ...data, status };
  }
};

export default request;
